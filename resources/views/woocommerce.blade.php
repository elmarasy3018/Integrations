<!DOCTYPE html>
<html>

<head>
    <title>Word Press</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white mt-5 p-6 rounded shadow-md">
        <form method="POST" action="/woocommerce">
            @csrf
            <div class="mb-4">
                <label for="store_url" class="block text-gray-700 text-sm font-bold mb-2">Store Url:</label>
                <input type="text" id="store_url" name="store_url" value="https://ahmedhisham.socialgossip.website/"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <div class="mb-4">
                <label for="consumer_key" class="block text-gray-700 text-sm font-bold mb-2">Consumer Key:</label>
                <input type="text" id="consumer_key" name="consumer_key" value="ck_2e1c2433e6d749f7e3850d0250e52a3fed361fd6"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <div class="mb-4">
                <label for="consumer_secret" class="block text-gray-700 text-sm font-bold mb-2">Consumer Secret:</label>
                <input type="text" id="consumer_secret" name="consumer_secret" value="cs_dfd798380086a9eca48d0577ab03fc2b6abd1800"
                    class="w-full p-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-400">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Fetch
                Data</button>
        </form>
    </div>
</body>

</html>
