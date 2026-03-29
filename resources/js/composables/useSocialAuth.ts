import { redirect } from "@/routes/auth/social"

type Provider = 'google' | 'spotify'

export function useSocialAuth() {
    const loginWith = (provider: Provider): void => {
        window.location.href = redirect(provider).url
    }

    return { loginWith }
}
