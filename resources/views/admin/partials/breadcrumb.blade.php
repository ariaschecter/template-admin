<!-- BEGIN: Breadcrumb -->
<div class="mb-5">
    <ul class="m-0 p-0 list-none">
        <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
            <a href="{{ route('admin.dashboard') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right"
                    class="relative text-slate-500 text-sm rtl:rotate-180">
                </iconify-icon>
            </a>
        </li>
        @foreach ($breadcrumbs as $breadcrumb)
            @if($breadcrumb[1] == true)
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                <a href="{{ $breadcrumb[2] }}">
                    {{ $breadcrumb[0] }}
                    <iconify-icon icon="heroicons-outline:chevron-right"
                        class="relative top-[3px] text-slate-500 rtl:rotate-180">
                    </iconify-icon>
                </a>
            </li>
            @else
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                {{ $breadcrumb[0] }}
            </li>
            @endif
        @endforeach
    </ul>
</div>
<!-- END: BreadCrumb -->
