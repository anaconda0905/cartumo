<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
    <div class="x_panel">
        <div class="x_content">
            <ul class="profile-sidebar">
                <li>
                    <strong>{{ $profile->user->name }}</strong>
                    <p style="margin: 0px;">{{ $profile->user->email }}</p>
                </li>

                <li class="pull-right">
                    <img src="{{ asset('images/users/'.$profile->avatar) }}"/>
                </li>
            </ul>

            <div class="profile-content">
                <table>
                    <tr>
                        <th>PLAN</th>
                        <td>
                            @if ( (!empty(Auth::user()->secret)) )
                                @if ( Auth::user()->secret == env('REGISTER_CODE_MONTHLY') )
                                    (${{ env('MONTHLY_PLAN') }} / MONTH)
                                @elseif ( Auth::user()->secret == env('REGISTER_CODE_YEARLY') )
                                    (${{ env('YEARLY_PLAN') }} / YEAR)
                                @elseif ( Auth::user()->secret == env('REGISTER_CODE_LIFETIME_PROMO') )
                                    <b style="color:#45b39c; text-transform: none">7 days free trial</b>
                                @else
                                    <b style="color:#45b39c; text-transform: none">Lifetime</b>
                                @endif
                            @else
                                {{-- @if ( Auth::user()->subscription('main')->onTrial() )
                                    <b style="color:#45b39c; text-transform: none">You are on Trial period</b>
                                @endif --}}
                                @if ( Auth::user()->subscribedToPlan('monthly', 'main') )
                                    (${{ env('MONTHLY_PLAN') }} / MONTH)
                                @else
                                    (${{ env('YEARLY_PLAN') }} / YEAR)
                                @endif
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th>SALES</th>
                        <td>${{ number_format($data['total_sales'], 2) }}</td>
                    </tr>
                    <tr>
                        <th>FUNNELS</th>
                        <td>{{ $data['total_funnels'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>