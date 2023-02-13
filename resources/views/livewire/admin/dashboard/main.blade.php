
<x-slot name="admin">
</x-slot>
<x-slot name="header">
    <p class="w-1/2 mx-0.5 text-left font-bold text-base sm:text-lg">Admin Dashboard</p>
    <p class="w-1/2 m-0.5 text-right">
        <a href="{{route('admin.dashboard')}}" class="hover:text-cyan-500 hover:underline">Admin</a>
    </p>
</x-slot>
<div class="w-full px-1 sm:px-8 py-1 sm:py-4">
    <div class="grid grid-cols-2 sm:grid-cols-4 grid-row gap-4 mb-4">
        <div class="relative pt-3 px-2 bg-blue-400 text-white rounded shadow-lg">
            <div class="inline-flex w-full justify-between mb-10">
                <div class="font-black w-1/2">
                    <p class="text-xl sm:text-4xl my-1">{{count($posts)}}</p>
                    <p class="my-1 ml-1">Berita</p>
                </div>
                <i class="fa-regular fa-newspaper font-black text-7xl text-right w-1/2 opacity-25"></i>
            </div>
            <a href="{{route('admin.posts')}}" class="absolute w-full bottom-0 left-0 right-0 h-10 bg-gray-900 opacity-25 hover:bg-gray-800 cursor-pointer">
                <div class="w-full h-full inline-flex justify-center">
                    <p class="my-auto mx-0.5">more</p>
                    <i class="fa-solid fa-arrow-right my-auto mx-0.5"></i>
                </div>
            </a>
        </div>
        <div class="relative pt-3 px-2 bg-green-400 text-white rounded shadow-lg">
            <div class="inline-flex w-full justify-between mb-10">
                <div class="font-black w-1/2">
                    <p class="text-xl sm:text-4xl my-1">{{count($users)}}</p>
                    <p class="my-1 ml-1">Pengguna</p>
                </div>
                <i class="fa-solid fa-users font-black text-7xl text-right w-1/2 opacity-25"></i>
            </div>
            <a href="{{route('admin.users')}}" class="absolute w-full bottom-0 left-0 right-0 h-10 bg-gray-900 opacity-25 hover:bg-gray-800 cursor-pointer">
                <div class="w-full h-full inline-flex justify-center">
                    <p class="my-auto mx-0.5">more</p>
                    <i class="fa-solid fa-arrow-right my-auto mx-0.5"></i>
                </div>
            </a>
        </div>
        <div class="relative pt-3 px-2 bg-yellow-400 text-white rounded shadow-lg">
            <div class="inline-flex w-full justify-between mb-10">
                <div class="font-black w-1/2">
                    <p class="text-xl sm:text-4xl my-1">{{count($categories)}}</p>
                    <p class="my-1 ml-1">Kategori</p>
                </div>
                <i class="fa-solid fa-quote-left font-black text-7xl text-right w-1/2 opacity-25"></i>
            </div>
            <a href="{{route('admin.categories')}}" class="absolute w-full bottom-0 left-0 right-0 h-10 bg-gray-900 opacity-25 hover:bg-gray-800 cursor-pointer">
                <div class="w-full h-full inline-flex justify-center">
                    <p class="my-auto mx-0.5">more</p>
                    <i class="fa-solid fa-arrow-right my-auto mx-0.5"></i>
                </div>
            </a>
        </div>
        <div class="relative pt-3 px-2 bg-red-400 text-white rounded shadow-lg">
            <div class="inline-flex w-full justify-between mb-10">
                <div class="font-black w-1/2">
                    <p class="text-xl sm:text-4xl my-1">{{count($tags)}}</p>
                    <p class="my-1 ml-1">Tagar</p>
                </div>
                <i class="fa-solid fa-tag font-black text-7xl text-right w-1/2 opacity-25"></i>
            </div>
            <a href="{{route('admin.tags')}}" class="absolute w-full bottom-0 left-0 right-0 h-10 bg-gray-900 opacity-25 hover:bg-gray-800 cursor-pointer">
                <div class="w-full h-full inline-flex justify-center">
                    <p class="my-auto mx-0.5">more</p>
                    <i class="fa-solid fa-arrow-right my-auto mx-0.5"></i>
                </div>
            </a>
        </div>
    </div>
    <div class="w-full sm:w-1/2 shadow-lg border py-2 px-1 border-solid rounded-lg">
        <canvas id="myChart" class="m-auto"></canvas>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
var labels =  {{ Js::from($post_labels) }};
var posts =  {{ Js::from($post_data) }};
  console.log(labels);
    const data = {
        labels: labels,
        datasets: [{
            label: 'Rekap Berita',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: posts,
        }]
    };
  
    const config = {
        type: 'line',
        data: data,
        options: {}
    };
  
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
  
</script>