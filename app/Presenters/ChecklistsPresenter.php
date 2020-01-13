<?php

namespace App\Presenters;

use App\Transformers\ChecklistsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ChecklistsPresenter.
 *
 * @package namespace App\Presenters;
 */
class ChecklistsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ChecklistsTransformer();
    }
}
