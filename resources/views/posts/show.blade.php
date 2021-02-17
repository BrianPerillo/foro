<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container mt-0 p-4" style="background-color: white">
            
            {{$post->id}}</br>
            {{$post->name}}</br>
            {!! $post->body !!}</br>
            {{$post->category->name}}</br></br></br>

            <div class="mx-auto items-center justify-center max-w-xl">

                @if (auth()->user())
                
                
                    <form action="{{route('posts.store_comment', [$post->id, $post->name])}}" method="POST">

                        @csrf

                            <!-- comment form -->
                            
                                
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <h2 class="px-4 pt-3 pb-2 text-gray-800 text-lg">Agregar Comentario</h2>
                                        <div class="w-full md:w-full px-3 mb-2 mt-2">
                                            <textarea class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="comment" placeholder='Escribir Comentario' required></textarea>
                                        </div>
                                        <div class="w-full md:w-full flex items-start md:w-full px-3">
                                            <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">
                                                <svg fill="none" class="w-5 h-5 text-gray-600 mr-1" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <p class="text-xs md:text-sm pt-px">Some HTML is okay.</p>
                                            </div>
                                            <div class="-mr-1">
                                                <input type='submit' class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100" value='Comentar'>
                                            </div>
                                        </div>
                                    </div>
                                
                            
                        

                    </form></br></br>
                    
                @else

                        <p><strong>Para poder comentar y responder comentarios debes Iniciar Sesión</strong></p>

                @endif



                @if(sizeOf($post->comments)!=0)
                    <p>Comentarios: </p>

                    @php $id_number = 0; @endphp

                    @foreach ($post->comments as $comment)

                        <div class="card m-3">
                            <div class="card-header p-2 pl-3">
                                Usuario: {{$comment->user->name}}
                            </div>
                            <div class="card-body p-2 pl-3">
                            <p class="card-text">{{$comment->message}}</p>
                            @if (auth()->user())
                                <div class="-mr-1">
                                    <input id="{{'responder'.$id_number}}" type='submit' style="float: right" class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100" 
                                    value='Responder' 
                                    onclick="responder({{$id_number}})">
                                </div>
                                </br></br>
                                        
                                <form id="{{'responder_'.$id_number}}" action="{{route('posts.store_answer', [$post, $comment ,])}}" method="post">
                                    @csrf
                                        <!-- Acá se carga el textarea para responder -->

                                </form>
                            @endif
                            </div>
                        </div>

                        @php $id_number = $id_number+1; @endphp
                                
                        <!-- Imprimo las respuestas del comentario-->
                        <div class="ml-5">
                            @foreach ($comment->answers as $answer)
                                    
                                <div class="card m-3">
                                    <div class="card-header p-2 pl-3" style="background-color:rgb(237, 237, 237)">
                                        Usuario: {{$answer->user->name}}
                                    </div>
                                    <div class="card-body p-2 pl-3" style="background-color:rgb(248, 248, 248)">
                                        <p class="card-text">{{$answer->body}}</p>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    @endforeach
                @endif
                        
            </div>

        </div>

    </div>
</x-app-layout>