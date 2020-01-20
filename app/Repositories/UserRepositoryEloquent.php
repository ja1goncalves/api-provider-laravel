<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function findIdNextAnalystTitular()
    {
        $init_today = Carbon::today()->format('Y-m-d H:i:s');
        $end_today = Carbon::tomorrow()->format('Y-m-d H:i:s');
        return DB::select("
                SELECT Users.id, count(providers.id) as total_providers
                from users Users
                LEFT JOIN providers on (providers.user_id = Users.id and providers.created BETWEEN {$init_today} and {$end_today})
                WHERE Users.analyst_titular = 1 and Users.group_id = 4
                GROUP BY Users.id
                ORDER BY total_providers ASC LIMIT 1")[0];
    }

}
