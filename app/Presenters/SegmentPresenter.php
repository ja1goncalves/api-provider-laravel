<?php

namespace App\Presenters;

use App\Transformers\SegmentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SegmentPresenter.
 *
 * @package namespace App\Presenters;
 */
class SegmentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SegmentTransformer();
    }
}
