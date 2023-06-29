<!-- BEGIN: Breadcrumb -->
<div class="mb-5">
    <ul class="m-0 p-0 list-none">
        <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
            <a href="{{ route('dashboard.admin') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right"
                    class="relative text-slate-500 text-sm rtl:rotate-180">
                </iconify-icon>
            </a>
        </li>
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                <a href="{{ $breadcrumb[1] }}">
                    {{ $breadcrumb[0] }}
                    <iconify-icon icon="heroicons-outline:chevron-right"
                        class="relative top-[3px] text-slate-500 rtl:rotate-180">
                    </iconify-icon>
                </a>
            </li>
        @endforeach
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
            {{ $breadcrumb_active }}</li>
    </ul>
</div>
<!-- END: BreadCrumb -->
