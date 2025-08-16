@extends('admin.layout.main')
@section('contentadmin')
<section class="bg-gray dark:bg-gray-900">
    <div class="w-full mx-auto bg-gray-800 dark:bg-gray-800 rounded-xl shadow-lg p-6">
      <h2 class="mb-4 text-xl font-bold text-white dark:text-gray-50">Buat Data Supplier</h2>
      <form action="{{ route('admin.supplier.store') }}" method="POST" enctype="multipart/form-data }}">
        @csrf
          <div class="">
              <div class="sm:col-span-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-white dark:text-white">Nama Supplier :</label>
                  <input type="text" name="name" id="name" class="bg-gray-0 transition duration-300 hover:bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
              </div>
          </div>
          
           <div class="">
            
              <div class="sm:col-span-2 mt-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-white dark:text-white">Alamat :</label>
                  <input type="text" name="address" id="address" class="bg-gray-0 transition duration-300 hover:bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
              </div>
          </div>
           <div class="">
              <div class="sm:col-span-2 mt-2">
                  <label for="phone" class="block mb-2 text-sm font-medium text-white dark:text-white">No.Telepon :</label>
                  <input type="text" name="phone" id="phone" class="bg-gray-0 transition duration-300 hover:bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
              </div>
          </div>
          <div class="">
              <div class="sm:col-span-2 mt-2">
                  <label for="email" class="block mb-2 text-sm font-medium text-white dark:text-white">Email :</label>
                  <input type="email" name="email" id="email" class="bg-gray-0 transition duration-300 hover:bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
              </div>
          </div>
          <div class="mt-8 flex justify-between items-center">
             <button type="submit" style="border-radius: 20vh"
               class="inline-flex items-center px-4 py-2.5 font-bold text-center text-white bg-orange-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-orange-400 transition duration-300">
                Tambah Supplier 
             </button>
             <a href="{{ route('admin.supplier.index') }}" style="font-size: medium; text-decoration: none;" class="text-white font-bold"> Kembali</a>
         </div>
      </form>
  </div>
</section>
@endsection