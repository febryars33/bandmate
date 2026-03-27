import type { Role } from "../auth"
import type { Musician } from "./musician"
import type { Organizer } from "./organizer"

export type User = {
    id: number
    username: string
    name: string
    email: string
    avatar?: string
    theme: string
    email_verified_at: string | null
    created_at: string
    updated_at: string
    roles: Role[]
    [key: string]: unknown
    musicianable: Musician | null
    organizers: Organizer[] | null
}
