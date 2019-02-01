<?php

namespace App\Presenters;

use App\Transformers\QuotationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class QuotationPresenter.
 *
 * @package namespace App\Presenters;
 */
class QuotationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new QuotationTransformer();
    }
}
