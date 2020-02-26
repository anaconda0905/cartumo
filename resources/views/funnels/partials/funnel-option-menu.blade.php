<div class="x_title">
    @if ( empty($templates) )
    <h2>{{ $currentStep->display_name }}</h2>
    <ul class="nav navbar-right panel_toolbox">
        <li>
            <a href="{{ route('steps.show', array($funnel->id, $currentStep->id)) }}"
               class="collapse-link active"><i class="fa fa-pie-chart"
                                               aria-hidden="true"></i> &nbsp;
                Overview</a>
        </li>

        @if ( (strtolower($currentType->name) == 'sales') || (strtolower($currentType->name) == 'product') || (strtolower($currentType->name) == 'upsell') || (strtolower($currentType->name) == 'downsell') )
        <li>
            <a href="{{ route('product.index', array($funnel->id, $currentStep->id)) }}"
               class="close-link"><i class="fa fa-cubes" aria-hidden="true"></i>
                &nbsp;
                Products</a>
        </li>

        <li>
            <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
               class="collapse-link"><i class="fa fa-plug"></i> &nbsp;
                Integration</a>
        </li>

        <!--<li>
                <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
                class="collapse-link"><i class="fa fa-plug"></i> &nbsp;
                    Integration</a>
            </li>-->
        @elseif ( (strtolower($currentType->name) == 'optin') )

        <li>
            <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
               class="collapse-link"><i class="fa fa-plug"></i> &nbsp;
                Integration</a>
        </li>

        @elseif ( (strtolower($currentType->name) == 'order') )
        <!--<li>
                <a href="{{ route('funnel.step.integration.show', array($funnel->id, $currentStep->id)) }}"
                class="collapse-link"><i class="fa fa-plug"></i> &nbsp;
                    Integration</a>
            </li>-->
        <li>
            <a href="{{ route('funnel.step.bump', array($funnel->id, $currentStep->id)) }}"
               class="close-link"><i class="fa fa-cube" aria-hidden="true"></i>
                &nbsp;
                Bump Product</a>
        </li>
        @elseif ( (strtolower($currentType->name) == 'confirmation') )
        <li>
            <a href="{{ route('funnel.step.email.show', array($funnel->id, $currentStep->id)) }}"
               class="collapse-link"><i class="fa fa-envelope"
                                        aria-hidden="true"></i> &nbsp;
                Email</a>
        </li>
        @endif
    </ul>
    @else
    <h2>Templates for <strong>{{ $currentStep->display_name }}</strong> page</h2>
    @endif
    <div class="clearfix"></div><br>
</div>