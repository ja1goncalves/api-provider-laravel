<?php

namespace App\Presenters;

use App\Transformers\PreProviderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PreProviderPresenter.
 *
 * @package namespace App\Presenters;
 */
class PreProviderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PreProviderTransformer();
    }
}
