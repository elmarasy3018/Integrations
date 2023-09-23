<!DOCTYPE html>
<html>

<head>
    <title>Shopify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white mt-5 p-6 rounded shadow-md">
        <form method="POST" action="/shopify">
            @csrf
            <div class="mb-4">
                <label for="access_token" class="block text-gray-700 text-sm font-bold mb-2">Shopify Access Token:</label>
                <input type="text" id="access_token" name="access_token" value="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"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <div class="mb-4">
                <label for="domain" class="block text-gray-700 text-sm font-bold mb-2">Shopify Domain:</label>
                <input type="text" id="domain" name="domain" value="ckdemo1.myshopify.com"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Fetch
                Data</button>
        </form>
    </div>
</body>

</html>
