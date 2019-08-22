<?php


namespace App\Services;


use App\Repositories\AddressRepository;
use App\Repositories\MessageRepository;
use App\Repositories\MessagesUserRepository;
use App\Repositories\PendingEditionRepository;
use App\Repositories\UserRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Database\Eloquent\Model;

class PendingEditionService
{
    use CrudMethods;

    /**
     * @var PendingEditionRepository
     */
    protected $repository;

    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * @var MessagesUserRepository
     */
    protected $messagesUserRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var AddressRepository
     */
    protected $addressRepository;

    /**
     * @var ProviderService
     */
    protected $providerService;

    /**
     * AddressService constructor.
     * @param PendingEditionRepository $repository
     * @param AddressRepository $addressRepository
     * @param ProviderService $providerService
     * @param MessageRepository $messageRepository
     * @param MessagesUserRepository $messagesUserRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ProviderService $providerService,
                                PendingEditionRepository $repository,
                                AddressRepository $addressRepository,
                                MessageRepository $messageRepository,
                                MessagesUserRepository $messagesUserRepository,
                                UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->providerService = $providerService;
        $this->addressRepository = $addressRepository;
        $this->messageRepository = $messageRepository;
        $this->messagesUserRepository = $messagesUserRepository;
        $this->userRepository = $userRepository;
    }

    public function beforeSave(Model $model, array $fields, string $alias)
    {
        $create_occurrence = false;
        foreach ($fields as $field){
            if($model->isDirty($field) && !empty($model->{$field}) && !empty($model->getOriginal($field))){
                $data = [
                    'model' => $alias,
                    'primary_key' => $model->getAttribute('id'),
                    'field' => $field,
                    'value' => $model->{$field}
                ];

                $create_occurrence = true;

                if(!$id = $this->duplicity($data)){
                    $this->create($data);
                }

//                $model->isDirty([$field => false]);
            }
        }
        if($create_occurrence) $this->create_occurrence($data, $alias);
    }

    public function duplicity($data)
    {
        $duplicity = $this->repository->findWhere([
            'model' => $data['model'],
            'primary_key' => $data['primary_key'],
            'field' => $data['field']
        ])->first();

        return $duplicity['id'];
    }

    public function create_occurrence($data, $alias)
    {
        try {
            switch ($alias) {
                case 'Providers':
                    $provider_id = $data['primary_key'];
                    break;

                case 'Addresses':
                    $address = $this->addressRepository->find($data['primary_key']);
                    $provider_id = $address->parent_id;
                    break;

                default:
                    throw new \Exception("Edição não relacionada a uma entidade");
                    break;
            }

            if (!is_null($provider_id)) {
                $provider = $this->providerService->find($provider_id);

                $user = $this->userRepository->findWhere([
                    'group_id' => 4, //ANÁLISE
                    'group_manager' => 1
                ])->first();

                $message = [
                    'created_by' => $user ? $user->id : 1,
                    'parent_id' => isset($provider->id) ? $provider->id : null,
                    'parent_name' => 'Providers',
                    'message_status_id' => 1, // PENDENTE
                    'text' => 'Dados pendentes para aprovação.'
                ];

                if ($message = $this->messageRepository->create($message)) {
                    if (isset($provider->user_id)) {
                        $messages_users = [
                            'message_id' => $message->id,
                            'user_id' => $provider->user_id
                        ];

                        $messages_users = $this->messagesUserRepository->create($messages_users);
                    }
                }
            }

        } catch (\Exception $e) {
            \Log::debug($e->getMessage());
        }
    }
}
