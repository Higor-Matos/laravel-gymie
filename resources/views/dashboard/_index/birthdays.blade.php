<div class="table-responsive {!! (! $birthdays->isEmpty() ? 'panel-scroll' : '')  !!}">
    <table class="table table-hover">
        @forelse($birthdays as $birthday)
            <tr>
                <?php
                $images = $birthday->getMedia('profile');
                $profileImage = ($images->isEmpty() ? 'https://www.pngall.com/wp-content/uploads/12/Avatar-PNG-Images-HD.png' : url($images[0]->getUrl('thumb')));
                ?>
                <td><a href="{{ action('MembersController@show',['id' => $birthday->id]) }}"><img
                                src="{{ $profileImage }}" style="width: 25px; height: 25px; margin-right: auto; margin-left: auto;"/></a></td>
                <td><a href="{{ action('MembersController@show',['id' => $birthday->id]) }}">{{ $birthday->name }}</a></td>
                <td>{{ $birthday->contact }}</td>
                <td>{{ $birthday->DOB }}</td>
            </tr>
        @empty
            <div class="tab-empty-panel font-size-24 color-grey-300">
                No Data
            </div>
        @endforelse
    </table>
</div>