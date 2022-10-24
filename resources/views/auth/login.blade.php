<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
  <meta charset=" UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login - Transaction App</title>
  {{-- app css --}}
  @vite('resources/css/app.css')
</head>

<body data-theme="dark" class="h-full">

  <div class="flex justify-center items-center h-screen px-5 lg:px-0">
    <div class="card w-[638px] bg-neutral text-neutral-content shadow-xl">
      <div class="card-body p-7">
        <h2 class="card-title">Please Login!</h2>
        @if (session()->has('authError'))
        <div class="alert alert-error shadow-lg mb-3 mt-4">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><strong>Error!</strong> {{ session('authError') }}</span>
          </div>
        </div>
        @endif
        <form action="{{ route('login.action') }}" method="post">
          @csrf
          <div class="form-control w-full mb-2">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input type="text" name="email" placeholder="Type your email here.."
              class="input input-bordered w-full @error('email') input-error @enderror" value="{{ old('email') }}"
              autofocus />
            @error('email')
            <label class="label error-message">
              <span class="label-text-alt text-error text-xs">{{ $message }}</span>
            </label>
            @enderror
          </div>
          <div class="form-control w-full">
            <label class="label">
              <span class="label-text">Password</span>
            </label>
            <input type="password" name="password" placeholder="Type your password here.."
              class="input input-bordered w-full @error('password') input-error @enderror" />
            @error('password')
            <label class="label error-message">
              <span class="label-text-alt text-error text-xs">{{ $message }}</span>
            </label>
            @enderror
          </div>
          <div class="card-actions justify-end">
            <button type="submit" class="btn btn-primary btn-block mt-10">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</body>

</html>