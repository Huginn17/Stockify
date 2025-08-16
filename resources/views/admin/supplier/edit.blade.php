@extends('admin.layout.main')
@section('contentadmin')
<section class="bg-gray dark:bg-gray-900">
  <div class="w-full mx-auto bg-gray-800 dark:bg-gray-800 rounded-xl shadow-lg p-6">
      <h3 class="mb-4 text-xl font-bold text-white dark:text-white"> Update Data Supplier </h3>
      <form action="{{ route('admin.supplier.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="">
              <div class="sm:col-span-2 mt-2">
                  <label for="name" class="block mb-2 text-sm text-white font-medium dark:text-white">Nama Supplier :</label>
                  <input type="text" name="name" id="name" value="{{ $supplier->name }}" class="bg-gray-50 transition duration-300 hover:bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
              </div>
          </div>
           <div class="">
              <div class="sm:col-span-2 mt-2">
                  <label for="name" class="block mb-2 text-sm text-white font-medium dark:text-white">Alamat :</label>
                  <input type="text" name="address" id="address" value="{{ $supplier->address }}" class="bg-gray-50 transition duration-300 hover:bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name">
              </div>
          </div>
           <div class="">
              <div class="sm:col-span-2 mt-2">
                  <label for="phone" class="block mb-2 text-sm text-white font-medium dark:text-white">No.Telepon :</label>
                  <input type="text" name="phone" id="phone" value="{{ $supplier->phone }}" class="bg-gray-50 border transition duration-300 hover:bg-gray-200 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name">
              </div>
          </div>
          <div class="">
              <div class="sm:col-span-2 mt-2">
                
                  <label for="email" class="block mb-2 text-sm text-white font-medium dark:text-white">Email :</label>
                  <input type="email" name="email" id="email" value="{{ $supplier->email }}" class="bg-gray-50 border transition duration-300 hover:bg-gray-200 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name">
              </div>
          </div>
       
        <div class="mt-8 flex justify-between items-center">
                <button type="submit" style="border-radius: 20vh"
                    class="inline-flex items-center px-4 py-2.5 bg-orange-500 hover:bg-orange-400 text-white font-bold rounded-md transition duration-300">
                    Perbarui Supplier
                </button>
             <form action="{{ route('admin.supplier.index') }}" method="GET"><br>
        <button type="submit" style="border-radius: 20vh"
            class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg  transition duration-300">
            Kembali
        </button>
    </form>
        </div>
      </form>
  </div>
</section>


@endsection