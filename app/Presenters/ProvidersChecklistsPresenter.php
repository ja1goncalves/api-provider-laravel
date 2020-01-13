<?php

namespace App\Presenters;

use App\Transformers\ProvidersChecklistsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProvidersChecklistsPresenter.
 *
 * @package namespace App\Presenters;
 */
class ProvidersChecklistsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProvidersChecklistsTransformer();
    }
}
