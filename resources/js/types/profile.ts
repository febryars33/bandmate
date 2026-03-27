export type Experience = {
    id: number
    band_name: string
    role: string
    start_year: number
    end_year: number | null
    description?: string
}

export type Profile = {
    id: number
    username: string
    name: string
    avatar: string
    location: string
    headline: string
    bio: string

    instruments: string[]
    genres: string[]

    experience_level: 'beginner' | 'intermediate' | 'professional'
    collaboration_status: 'open' | 'looking' | 'closed'

    connections_count: number
    projects_count: number

    experiences: Experience[]
}
