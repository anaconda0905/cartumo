<ul class="funnel-inner-header-menu text-right">
    <li><a href="{{ route('funnels.show', $funnel->id) }}"><span
                    class="fa fa-dashboard"></span> Dashboard</a></li>
    <li><a href="{{ route('steps.index', $funnel->id) }}"
           class="{{ (!empty($currentStep)) ? 'active' : '' }}"><span
                    class="fa fa-bars"></span> Steps</a></li>
<!--<li><a href="#" class="{{ (!empty($currentStats)) ? 'active' : '' }}"><span
                                            class="fa fa-bar-chart"></span> Stats</a></li>-->
    <li><a href="{{ route('contacts.index', $funnel->id) }}"
           class="{{ (!empty($currentContacts)) ? 'active' : '' }}"><span
                    class="fa fa-users"></span> Contacts</a></li>
    <li><a href="{{ route('funnel.sales.index', $funnel->id) }}"
           class="{{ (!empty($currentSales)) ? 'active' : '' }}"><span
                    class="fa fa-money"></span> Sales</a></li>
    <li><a href="{{ route('funnels.edit', [$funnel->id]) }}"><span class="fa fa-cog"
                                                                   aria-hidden="true"></span>Settings</a>
    </li>

    @if ( App\Models\UserUpgrade::isUpgradeAvailable(Auth::id(), 2) )
        <li><a href="{{ route('funnels.upload.store', [$funnel->id]) }}"
               class="{{ (!empty($uploads)) ? 'active' : '' }}"><span
                        class="fa fa-cloud-upload"></span> Upload</a></li>
    @endif
</ul>