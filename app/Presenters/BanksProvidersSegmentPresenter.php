<?php

namespace App\Presenters;

use App\Transformers\BanksProvidersSegmentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BanksProvidersSegmentPresenter.
 *
 * @package namespace App\Presenters;
 */
class BanksProvidersSegmentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BanksProvidersSegmentTransformer();
    }
}
