@props([
    'elements' => [], 
    'type' => 'posts', 
    'search_chars' => '',
    'user' => false,
    'route_name' => 'home'
])

<div>
    @switch($type)
        @case('posts')

            @foreach ($elements as $post)
                
                <x-post 
                    :post="$post" 
                    :search_chars="$search_chars"
                    :user="$user"
                    :route_name="$route_name"
                />

            @endforeach
            
            @break

        @case('profiles')
            
            @foreach ($elements as $profile)
            
                <x-profile 
                    :profile="$profile" 
                    :search_chars="$search_chars"
                    :user="$user"
                />

            @endforeach

            @break

        @case('tags')
        
        

            @break
            
    @endswitch
</div>