@if (session('message') !== null)
    <div
        class="py-[18px] px-6 font-normal font-Inter text-sm rounded-md {{ session('color') }} text-white dark:{{ session('color') }} dark:text-slate-300">
        <div class="flex items-start space-x-3 rtl:space-x-reverse">
            <div class="flex-1">
                {{ session('message') }}
            </div>
        </div>
    </div>
@endif
    