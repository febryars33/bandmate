import type { Musician } from "../musician";

export type ArtistMusician = {
    id: number
    name: string | null
    artist_id: number
    musician_id: number | null
    joined_at: string | null
    left_at: string | null
    instruments: string[]
    musician?: Musician | null
};
