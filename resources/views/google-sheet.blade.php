<!DOCTYPE html>
<html>

<head>
    <title>Google Sheet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white mt-5 p-6 rounded shadow-md">
        <form method="POST" action="/google-sheet">
            @csrf
            <div class="mb-4">
                <label for="google_sheet_link" class="block text-gray-700 text-sm font-bold mb-2">Google Sheet
                    Link:</label>
                <input type="text" id="google_sheet_link" name="google_sheet_link" placeholder="Enter Google Sheet link"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Fetch
                Data</button>
        </form>
    </div>

    @if (isset($table))
    <div class="mt-8">
        <table class="min-w-full bg-white">
            {!! $table !!}
        </table>
    </div>
    @endif
</body>

</html>