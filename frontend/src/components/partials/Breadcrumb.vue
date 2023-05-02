<template>
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">
                            {{ $router.currentRoute.value.name }}
                        </h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"
                                ><i class="feather icon-home"></i
                            ></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#!">
                                {{ $router.currentRoute.value.name }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Breadcrumb",
    data() {
        return {
            icons: {
                Dashboard: "icon-home",
                Users: "icon-users",
            },
            currentIcon: "icon-home",
        };
    },
};
</script>
