<div class="funnel-lists">
    <ul>
        @if ( count($funnels) > 0 )
            @foreach ($funnels as $key => $funnel)
                <li>
                    <ul class="funnel-list-item">
                        <li>
                            @if ( $funnel->type == 'manual' )
                                <div class="funnel-demo-icon">
                                    <span class="glyphicon glyphicon-filter"></span>
                                </div>
                            @else
                                <div class="funnel-demo-icons">
                                    <img src="{{ asset('global/img/shopify.png') }}" style="width: 52px"/>
                                </div>
                            @endif
                        </li>
                        <li>
                            <h3>
                                <a href="{{ route('funnels.show', $funnel->id) }}">{{ $funnel->name }}</a>
                            </h3>
                            <p>
                                <span>{{ date('d M, Y h:i a', strtotime($funnel->created_at)) }}</span>
                            </p>
                        </li>
                        <li class="inline-content">
                            <div>
                                <strong>{{ $funnel->steps->count() }}</strong> STEPS
                            </div>
                            <div><i class="fa fa-star-o" aria-hidden="true" title="Bookmark"></i><br/></div>

                            <div>
                                <a href="{{ route('funnels.edit', $funnel->id) }}"
                                    class="btn btn-warning" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <button class="btn btn-danger funnel_remove" data-funnel-id="{{ $funnel->id }}" title="Remove">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                <br/>
                            </div>

                        </li>
                    </ul>
                </li>
            @endforeach
        @else
            <p>No funnels</p>
        @endif
    </ul>
</div>