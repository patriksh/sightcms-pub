// somebody toucha my spaghet

export const parseDeeplink = (url: string): any => {
    const domain = 'grad-zabok.sightcms.app';
    const pathArr = url.split(domain); // ['https://grad-zabok.sightcms.app', '/some-path']
    const appPath = pathArr.pop(); // '/some-path'

    if(appPath) {
        // Handle list paths.
        const moreListPaths = ['documents', 'attractions', 'gastronomy']; // Those are on the more tab.
        const listPaths = ['articles', 'events', ...moreListPaths];
        for(const listPath of listPaths) {
            if(appPath.startsWith(`/${listPath}`)) {
                // Get the category slug from the path if it exists.
                const categoryPath = appPath.split(`/${listPath}/`)[1];
                const category = categoryPath?.split('/')[0];
                if(moreListPaths.includes(listPath)) {
                    return {
                        tab: 'more',
                        route: `/tabs/more/${listPath}/${category ? `category/${category}` : ''}`
                    };
                } else {
                    return {
                        tab: listPath,
                        route: `/tabs/${listPath}/${category ? `category/${category}` : ''}`
                    };
                }
            }
        }

        // Handle single paths.
        const moreSinglePaths = ['document', 'attraction']; // Those are on the more tab.
        const singlePaths = ['article', 'event', ...moreSinglePaths];
        for(const singlePath of singlePaths) {
            if(appPath.startsWith(`/${singlePath}/`)) {
                const slug = appPath.split('/').pop();
                if(moreSinglePaths.includes(singlePath)) {
                    return {
                        tab: 'more',
                        route: `/tabs/more/${singlePath}s/view/${slug}`
                    };
                } else {
                    return {
                        tab: singlePath,
                        route: `/tabs/${singlePath}s/view/${slug}`
                    };
                }
            }
        }

        // Gastronomy has a special path for view single...
        if(appPath.startsWith('/gastronomy/view')) {
            const slug = appPath.split('/').pop();
            return {
                tab: 'more',
                route: `/gastronomy/show/${slug}`
            };
        }
    }
}