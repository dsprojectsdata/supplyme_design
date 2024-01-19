@forelse($ccg_feeds as $ccg_feed)
    <x-admin.single-feed :feed=$ccg_feed />
@empty
    <div class="row">
        <div class="col">
            <p class="text-center">
                No Feeds available
            </p>
        </div>
    </div>
@endforelse