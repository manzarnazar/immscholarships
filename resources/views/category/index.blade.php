@extends('../layout/' . $layout)

@section('subhead')
    <title>Catgory - IMS Scholarship Portal</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Category</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Responsive Table -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                    <h2 class="font-medium text-base mr-auto">Category</h2>
                    <a href="{{ route('category-create') }}" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">{{ __('Add Category') }}</a>

                </div>
                <div class="p-5 " id="responsive-table" >
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <table class="table display" style="width:100%" id="category-table">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">#</th>
                                        <th class="whitespace-nowrap">Category Name</th>
                                        <th class="whitespace-nowrap">Description</th>
                                        <th class="whitespace-nowrap">Date Created</th>
                                        <th class="whitespace-nowrap">Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($category as $key =>  $item)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ ++$key }}</td>
                                        <td class="whitespace-nowrap">{{ strtoupper($item->name) }}</td>
                                        <td class="whitespace-nowrap">{{ $item->description }}</td>
                                        <td class="whitespace-nowrap">{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>
                                        <td class="whitespace-nowrap"><a class="btn btn-primary btn-sm text-white"><i data-feather="edit" class="block mx-auto"></i></a>
                                             <a
                                            class="btn btn-danger btn-sm text-white"><i data-feather="trash" class="block mx-auto"></i></a></td>

                                    </tr>
@endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

<script>
    new DataTable('#category-table');
</script>
@endsection
