<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">系统开发者</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @if(count($developer)>0)
                @foreach($developer as $key=>$val)
                    <li class="item"><span style="font-weight: bold">{{ucfirst($key)}}:</span> {{$val}} </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
