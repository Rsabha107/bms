@props(['items', 'prefix' => ''])

<ol class="toc-list">
    @foreach($items as $index => $item)
        @php
            $number = $prefix ? $prefix . '.' . ($index + 1) : ($index + 1);
        @endphp

        <li>
            <div class="toc-item">
                <span class="toc-title"><strong>{{ $number }}.</strong> {{ $item->title }}</span>
                @if($item->page_number)
                    <span class="toc-page">{{ $item->page_number }}</span>
                @endif
            </div>

            @if($item->children->isNotEmpty())
                <x-bbs.customer.menu :items="$item->children" :prefix="$number" />
            @endif
        </li>
    @endforeach
</ol>

<style>
.toc-list {
    list-style: none;
    padding-left: 20px;
}
.toc-item {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px dotted #999;
    padding: 2px 0;
}
.toc-page {
    flex-shrink: 0;
    text-align: right;
    min-width: 30px;
}
.toc-title {
    flex-grow: 1;
}
</style>
