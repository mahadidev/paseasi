<x-app-layout>
    <section class="py-12 sm:py-24">
        <form class="container" action="{{  route('need-help.store')}}" method="post" enctype='multipart/form-data'>

            {{ @csrf_field() }}
            <div class="rounded-xl bg-white p-4 sm:p-12 shadow">
                <h1>Request a help?</h1>
                <div class="p-4 md:p-5 flex flex-col gap-5">
                    <x-form-input label="Name" name="name" id="name" placeholder="ex. Salman Muqtadir" :value="old('name')" />

                    <x-form-textarea label="Details" name="details" id="details"
                        placeholder="ex. এখটা বোট প্রয়োজন ত্রাণ পোঁছানোর জন্য।" required>{{old("details")}}</x-form-textarea>

                    <x-form-input label="Location" name="location"  placeholder="ex. Feni Bus Stand." :value="old('location')" />

                    <x-form-input label="Phone number" name="phone" id="phone" placeholder="ex. 01xxxxxxxxx" :value="old('phone')"
                        required />

                    <x-form-input label="Phone Optional" name="phone_optional" id="phone" placeholder="ex. 01xxxxxxxxx" :value="old('phone_optional')"
                         />

                    <x-form-file label="Upload a picture" name="picture" id="picture" type="file"  />


                    <div class="flex items-center border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button  type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        <a href="{{ route('need-help.index') }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
</x-app-layout>
