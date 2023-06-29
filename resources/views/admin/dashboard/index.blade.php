@extends('admin.admin_template')

@section('main')
    <div class="flex justify-between flex-wrap items-center mb-6">
        <h4
            class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-4 sm:mb-0 flex space-x-3 rtl:space-x-reverse">
            Dashboard</h4>
    </div>

    <div class="grid grid-cols-12 gap-5 mb-5">
        <div class="col-span-12">
            <div class="p-4 card">
                <div class="grid md:grid-cols-4 col-span-1 gap-4">

                    <!-- BEGIN: Group Chart2 -->


                    <div class="py-[18px] px-4 rounded-[6px] bg-[#E5F9FF] dark:bg-slate-900	 ">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline1"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                    Totel revenue
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    3,564
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-[18px] px-4 rounded-[6px] bg-[#FFEDE5] dark:bg-slate-900	 ">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline2"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                    Products sold
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    564
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF] dark:bg-slate-900	 ">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline3"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                    Growth
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    +5.0%
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END: Group Chart2 -->
                </div>
            </div>
        </div>
    </div>
@endsection
