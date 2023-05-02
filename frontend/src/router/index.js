import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "Dashboard",
        component: () =>
        import(/* webpackChunkName: "dashboard" */ '@/components/dashboard/Dashboard.vue'),
        props: (route) => ({ search: route.query.search || "" })
    },
    {
        path: "/book/:id/view",
        name: "ViewBook",
        component: () =>
        import(/* webpackChunkName: "view" */ '@/components/dashboard/View.vue'),
        props: true,
    },
    {
        path: "/books",
        name: "Books",
        component: () =>
        import(/* webpackChunkName: "index" */ '@/components/books/Index.vue'),
    },
    {
        path: "/book/add",
        name: "AddBook",
        component: () =>
        import(/* webpackChunkName: "addbook" */ '@/components/books/Add.vue'),
    },
    {
        path: "/book/:id/edit",
        name: "EditBook",
        component: () =>
        import(/* webpackChunkName: "editbook" */ '@/components/books/Edit.vue'),
        props: true,
    },
    {
        path: "/:catchAll(.*)",
        name: "NotFound",
        component: () =>
        import(/* webpackChunkName: "notfound" */ '@/components/partials/error/NotFound.vue'),
      },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
