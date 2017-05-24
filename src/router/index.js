import Vue from 'vue';
import Router from 'vue-router';

import scopes from './scopes';
import routes from './routes';

import Login from '../components/Login';
import Install from '../components/Install';
import Packages from '../components/packages/Base';
import PackagesList from '../components/packages/List';
import PackagesSearch from '../components/packages/Search';
import LogViewer from '../components/tools/LogViewer';

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: '/',
            redirect: routes.login,
        },
        {
            name: routes.login.name,
            path: '/login',
            meta: { scope: scopes.LOGIN },
            component: Login,
        },
        {
            name: routes.install.name,
            path: '/install',
            meta: { scope: scopes.INSTALL },
            component: Install,
        },
        {
            path: '/packages',
            component: Packages,
            children: [
                {
                    name: routes.packages.name,
                    path: '',
                    meta: { scope: scopes.MANAGER },
                    component: PackagesList,
                },
                {
                    name: routes.packagesSearch.name,
                    path: 'search',
                    meta: { scope: scopes.MANAGER },
                    component: PackagesSearch,
                    props: true,
                },
            ],
        },
        {
            name: routes.logViewer.name,
            path: '/logs',
            meta: { scope: scopes.MANAGER },
            component: LogViewer,
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.meta.scope === undefined
        || (router.scope !== undefined && router.scope !== to.meta.scope)
    ) {
        next(false);
    } else {
        next();
    }
});

export default router;
