<?php

namespace App\Presenters;

use App\Transformers\ProgramTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProgramPresenter.
 *
 * @package namespace App\Presenters;
 */
class ProgramPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProgramTransformer();
    }
}
