import { RouteParams, Router } from 'ziggy-js';
import Echo from '../echo';
declare global {
    function route(): Router;
    function route(name: string, params?: RouteParams<typeof name> | undefined, absolute?: boolean): string;
      interface Window {
        Echo: Echo;
        Pusher: any;
    }
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: typeof route;
    }
}
