<?php

namespace App\Presenters;

use App\Transformers\ProgramsQuotationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProgramsQuotationPresenter.
 *
 * @package namespace App\Presenters;
 */
class ProgramsQuotationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProgramsQuotationTransformer();
    }
}
