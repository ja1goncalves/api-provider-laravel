<?php

namespace App\Presenters;

use App\Transformers\EmissionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EmissionPresenter.
 *
 * @package namespace App\Presenters;
 */
class EmissionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EmissionTransformer();
    }
}
