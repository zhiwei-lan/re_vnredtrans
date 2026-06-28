
<?= $this->include('Frontend/default/load/google_map') ?>
<gmp-map
    center="<?= config('Site')->map_loaction1 ?>" zoom="16" map-id="map1">
    <gmp-advanced-marker
        position="<?= config('Site')->map_loaction1 ?>" title="Ottumwa, IA"></gmp-advanced-marker>
</gmp-map>

<gmp-map
    center="<?= config('Site')->map_loaction1 ?>" zoom="16" map-id="map1">
    <gmp-advanced-marker
        position="<?= config('Site')->map_loaction1 ?>" title="Ottumwa, IA"></gmp-advanced-marker>
</gmp-map>
