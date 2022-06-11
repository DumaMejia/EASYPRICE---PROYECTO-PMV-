<template>
    <div id="appMapa">
        
        
   
    

            <div class="container m-3 ">
                
                <div class="card" style="width: 1200px; height: 400px;">
                <x-maps-leaflet 
                    :centerPoint="['lat' == 13.341835133794397, 'long' == -88.4186510089188]"
                    :markers="[['lat' == 13.341835133794397, 'long' == -88.4186510089188]]">
                    
                </x-maps-leaflet>
                </div>
                
            </div>

    </div>

</template>

<script>
    
</script>
