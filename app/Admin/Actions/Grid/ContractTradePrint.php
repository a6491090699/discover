<?php

namespace App\Admin\Actions\Grid;

use App\Models\FrameContract;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContractTradePrint extends RowAction
{
    /**
     * @return string
     */
    protected $title = '<i class="feather icon-printer"></i>';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // dump($this->getKey());

        $obj = FrameContract::find($this->getKey());
        return $this->response()
            // ->success('Processed successfully: '.$this->getKey())
            ->redirect(route('order.contractPrint', [$this->getKey(), 'type' => 'trade']));
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        // return ['Confirm?', 'contents'];
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
