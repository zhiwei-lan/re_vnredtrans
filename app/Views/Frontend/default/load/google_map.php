
<?= $this->section('js') ?>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBu2I93G-q31LtElIMQ7WRl_T1uG3Si7o&loading=async&language=<?= service('lang')->getLocale() ?>&callback=initMap">
</script>
<script>
	async function initMap() {
        const [{ Map }, { AdvancedMarkerElement }] = await Promise.all([
            google.maps.importLibrary('maps'),
            google.maps.importLibrary('marker'),
        ]);
        const mapElement = document.querySelector('gmp-map');
        mapElement.forEach((map)=>{
            console.log(item,index)
            const innerMap = map.innerMap;
            innerMap.setOptions({
                mapTypeControl: false,
            });
            const marker = new AdvancedMarkerElement({
                map: innerMap,
                position: map.center
            });
        })
    }
    initMap();
</script>
<?= $this->endSection() ?>