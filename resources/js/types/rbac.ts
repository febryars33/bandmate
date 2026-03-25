import type { User } from "./auth"

export function hasRole(user: User | null, role: string): boolean {
    console.log(user);
    if (!user) {
        return false
    }
    return true;
    // if (!user) return false
    // return user.roles.some(r => r.name === role)
}

export function hasAnyRole(user: User | null, roles: string[]): boolean {
    if (!user) return false
    return user.roles.some(r => roles.includes(r.name))
}
