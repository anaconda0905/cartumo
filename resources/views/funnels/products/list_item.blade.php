<div class="row products">
    <div class="col-md-7">
        <strong class="product-title"><i class="fa fa-cube" aria-hidden="true"></i> {{ $stepProduct->product->name }}</strong>
    </div>

    <div class="col-md-5">
        <div class="horizontal">
            <span class="procuct-item-member product-price">Price: ${{ $stepProduct->product->price }}</span>
            <span class="pull-right">
                <!--<button type="button" data-step-product-id="{{ $stepProduct->id }}" data-product-funnel-id="{{ $stepProduct->funnel_id }}" data-product-step-id="{{ $stepProduct->step_id }}" class="btn btn-warning product-edit" data-toggle="modal" data-target="#productEditModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>-->
                <button class="btn btn-danger"><i class="fa fa-fw fa-trash" aria-hidden="true"></i> Remove</button>
            </span>
        </div>
    </div>
</div>
