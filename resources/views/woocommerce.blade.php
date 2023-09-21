<!DOCTYPE html>
<html>

<head>
    <title>Shopify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white mt-5 p-6 rounded shadow-md">
        <form method="POST" action="/woocommerce">
            @csrf
            <div class="mb-4">
                <label for="store_url" class="block text-gray-700 text-sm font-bold mb-2">Shopify Access Token:</label>
                <input type="text" id="store_url" name="store_url" value="https://woo-sweetly-important-panda.wpcomstaging.com/"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <div class="mb-4">
                <label for="consumer_key" class="block text-gray-700 text-sm font-bold mb-2">Shopify Domain:</label>
                <input type="text" id="consumer_key" name="consumer_key" value="ck_a713c773dbf64a0848b52bd4425af1687394632b"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <div class="mb-4">
                <label for="consumer_secret" class="block text-gray-700 text-sm font-bold mb-2">Shopify Domain:</label>
                <input type="text" id="consumer_secret" name="consumer_secret" value="cs_1b9251a89be1cd911c3860cb1f44eae654b1a679"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Fetch
                Data</button>
        </form>
    </div>
</body>

</html>