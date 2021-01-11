@extends('status')
@section('status')

@if(session()->has('rst_message'))
<div  class="text-gray-900 bg-gray-200">

    <div class="pt-20 pb-10 flex justify-center">
        <h1 class="text-3xl text-red-500">
            Error!
        </h1>
    </div>
     <p class="text-center pb-10 text-gray-600 px-2">{{session()->get('rst_message')}}</p>
</div>
 @elseif($passwordReset)
 <div class="container mx-auto my-5 md:my-40">
			<div class="flex justify-center px-6 my-5 md:my-40">
				
				<div class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
						style="background-image: url('https://cdn.pixabay.com/photo/2017/03/23/12/56/security-2168233_960_720.jpg')"
					></div>
					<!-- Col -->
					<div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
						<div class="px-8 mb-4 text-center">
							<h3 class="pt-4 mb-2 text-2xl">Reset Your Password?</h3>
							<p class="mb-4 text-sm text-gray-700">
								Carefully choose a new password and confirm it to reset your password.
							</p>
						</div>
						<form class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
							<div class="mb-4 md:flex md:justify-between">
								<div class="mb-4 md:mr-2 md:mb-0">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="password">
										Password
									</label>
									<input
										class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="password"
										type="password"
										placeholder="******************"
									/>
							<!--		<p class="text-xs italic text-red-500">Please choose a password.</p> -->
								</div>
								<div class="md:ml-2">
									<label class="block mb-2 text-sm font-bold text-gray-700" for="password_confirmation">
										Confirm Password
									</label>
									<input
										class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
										id="password_confirmation"
										type="password"
										placeholder="******************"
									/>
								</div>
							</div>

							<div class="mb-6 text-center">
								<button
									class="w-full px-4 py-2 font-bold text-white bg-teal-500 rounded-full hover:bg-teal-700 focus:outline-none focus:shadow-outline"
									type="submit"
								>
									Confirm Password
								</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
 @else

 <div  class="text-gray-900 bg-gray-200">

    <div class="pt-20 pb-10 flex justify-center">
        <h1 class="text-3xl text-red-500">
            Error!
        </h1>
    </div>
     <p class="text-center pb-10 text-gray-600 px-2">Invalid token, please try again..</p>
</div>

@endif

@endsection