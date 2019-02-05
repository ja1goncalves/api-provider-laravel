<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 11:58
 */

namespace App\Presenters;

use App\Transformers\QuotationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SegmentPresenter.
 *
 * @package namespace App\Presenters;
 */
class QuotationsPresenter extends FractalPresenter
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
