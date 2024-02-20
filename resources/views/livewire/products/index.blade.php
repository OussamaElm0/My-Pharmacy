<table class="table-auto w-full bg-white shadow-md rounded-lg">
    <thead class="bg-gray-50">
    <tr>
        <th class="px-4 py-2 text-left"> # </th>
        <th class="px-4 py-2 text-left"> Name </th>
        <th class="px-4 py-2 text-left"> Type </th>
        <th class="px-4 py-2 text-left"> Category </th>
        <th class="px-4 py-2 text-left"> Price </th>
        <livewire:order-quantity />
        <th class="px-4 py-2 text-left"> Importation Date </th>
        <th class="px-4 py-2 text-left"> Expiration Date </th>
        <th class="px-4 py-2 text-left">Actions</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
    @foreach($products as $product)
        <tr>
            <td class="px-4 py-2">{{ $product->id }}</td>
            <td class="px-4 py-2">{{ $product->name }}</td>
            <td class="px-4 py-2">{{ $product->type->name }}</td>
            <td class="px-4 py-2">{{ $product->category->name }}</td>
            <td class="px-4 py-2">{{ $product->price }}</td>
            <livewire:product-quantity :currentQuantity="$product->quantity" :id="$product->id" />
            <td class="px-4 py-2">{{ $product->importation_date }}</td>
            <td class="px-4 py-2">{{ $product->expiration_date }}</td>
            <td>
                <button class="btn btn-outline-primary">
                    <a href="{{ route("products.show",['product' => $product->id]) }}">
                        Show
                    </a>
                </button>
                <button class="btn btn-outline-warning">
                    <a href="{{ route("products.edit",['product' => $product->id]) }}">
                        Edit
                    </a>
                </button>
                <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger font-bold py-2 px-4 rounded ml-2">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
