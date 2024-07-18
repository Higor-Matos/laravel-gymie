<?php
    use Carbon\Carbon;
?>
<div class="table-responsive {!! (! $expirings->isEmpty() ? 'panel-scroll' : '')  !!}">
    <table class="table table-hover table-condensed">
        @forelse($expirings as $expiring)
            <tr>
                <td>
                    <?php
                    $images = $expiring->member->getMedia('profile');
                    $profileImage = ($images->isEmpty() ? 'https://www.pngall.com/wp-content/uploads/12/Avatar-PNG-Images-HD.png' : url($images[0]->getUrl('thumb')));
                    ?>
                    <a href="{{ action('MembersController@show',['id' => $expiring->member->id]) }}">
                        <img src="{{ $profileImage }}" style="width: 50px; height: 50px; margin-right: auto; margin-left: auto;"/></a>
                </td>

                <td>
                    <a href="{{ action('MembersController@show',['id' => $expiring->member->id]) }}">
                        <span class="table-sub-data">{{ $expiring->member->member_code }}</span></a>
                    <a href="{{ action('MembersController@show',['id' => $expiring->member->id]) }}">
                        <span class="table-sub-data">{{ $expiring->member->name }}</span></a>
                </td>
                <?php
                $daysLeft = Carbon::today()->diffInDays($expiring->end_date->addDays(1));
                ?>
                <td>
                    <span class="table-sub-data">{{ $expiring->end_date->format('d/m/Y') }}<br></span>
                    <span class="table-sub-data">{{ Carbon::today()->addDays($daysLeft)->diffForHumans() }}</span>
                </td>

                @permission(['manage-gymie','manage-subscriptions','renew-subscription'])
                <td>
                    <a class="btn btn-info btn-xs btn pull-right"
                       href="{{ action('SubscriptionsController@renew',['id' => $expiring->invoice_id]) }}">Renew</a>
                </td>
                @endpermission
            </tr>
        @empty
            <div class="tab-empty-panel font-size-24 color-grey-300">
                No Data
            </div>
        @endforelse
    </table>
</div>
@if(!$expirings->isEmpty())
    <a class="btn btn-color btn-xs palette-concrete pull-right margin-right-10 margin-top-10"
       href="{{ action('SubscriptionsController@expiring') }}">View All</a>
@endif