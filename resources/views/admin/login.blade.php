{{-- Login Admin Manual --}}
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin Desa Sukaraja</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
  <form action="{{ route('admin.login.submit') }}" method="POST" class="bg-white p-8 rounded shadow-md w-96">
    @csrf
    <h2 class="text-2xl font-bold mb-6 text-center">Login Admin</h2>
    @if($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-4 rounded text-sm">
      {{ $errors->first() }}
    </div>
    @endif
    <div class="mb-4">
      <label for="email" class="block mb-1">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" class="border rounded w-full p-2" required>
    </div>
    <div class="mb-4">
      <label for="password" class="block mb-1">Password</label>
      <input type="password" name="password" id="password" class="border rounded w-full p-2" required>
    </div>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded w-full">Login</button>
  </form>
</body>

</html>
