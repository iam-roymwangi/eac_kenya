<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import {
    BookOpen,
    Folder,
    FolderKanban,
    LayoutGrid,
    Users,
} from 'lucide-vue-next';

import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import admin from '@/routes/admin';
import { type NavItem } from '@/types';

import AppLogo from './AppLogo.vue';

const page = usePage();
const user = page.props.auth.user;

const mainNavItems = computed<NavItem[]>(() => {
    const items: NavItem[] = [
        {
            title: 'Dashboard',
            href: dashboard(),
            icon: LayoutGrid,
        },
    ];

    if (user.role === 'admin') {
        items.push(
            {
                title: 'Project Management',
                href: admin.projects.index.url(),
                icon: FolderKanban,
            },
            {
                title: 'Manage Clients',
                href: '/admin/clients',
                icon: Users,
            },
            {
                title: 'Register Client',
                href: '/admin/clients/create',
                icon: Users,
            }
        );
    } else if (user.role === 'client') {
        items.push(
            {
                title: 'My Projects',
                href: '/client/projects',
                icon: FolderKanban,
            }
        );
    }

    return items;
});

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
