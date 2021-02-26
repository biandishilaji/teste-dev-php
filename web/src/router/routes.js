import Cars from './Car/routes'

const baseRoutes = [
    {
        path: "/",
        redirect: {
            name: "car.index"
        }
    },
];

const routes = baseRoutes.concat(Cars);

export default routes;
