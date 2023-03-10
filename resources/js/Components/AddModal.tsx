import { useEffect, useState } from "react";
import { router } from "@inertiajs/react";

const AddModal = (props: any) => {
    const closeModal = () => {
        props.setShowModal(false);
        props.setAdditionalMovieValue({
            ...props.additionalMovieValue,
            title: "",
            poster_path: "",
        });
    };

    const [postData, setPostData] = useState({
        title: "",
        memo: "",
        poster_path: "",
        userId: props.auth.user.id,
        is_done: 0,
    });

    useEffect(() => {
        setPostData({
            ...postData,
            title: props.additionalMovieValue.title,
            poster_path: props.additionalMovieValue.poster_path,
        });
    }, [props]);

    const onFinish = () => props.setLoading(false);

    const onSubmit = () => {
        props.setLoading(true);
        setPostData({
            ...postData,
            title: props.additionalMovieValue.title,
            poster_path: props.additionalMovieValue.poster_path,
        });

        const url = route("want.movie.create");
        router.post(url, postData, { onFinish });
        closeModal();
        props.setAdditionalMovieValue({
            ...props.additionalMovieValue,
            title: "",
            poster_path: "",
        });
    };

    const searchImages = () => {
        const url = route("want.movie.search");
        router.get(url, postData);
    };

    return (
        <>
            {props.showFlag || props.passedShowFlag ? (
                <div className="fixed top-0 left-0 right-0 w-hull h-full flex items-center justify-center bg-black bg-opacity-70">
                    <div className="bg-white m-10 p-10 rounded">
                        <p>This is ModalContent</p>
                        <button onClick={closeModal}>close</button>
                        <div className="flex flex-col">
                            <div>
                                <input
                                    type="text"
                                    value={props.additionalMovieValue.title}
                                    onChange={(e) => {
                                        setPostData({
                                            ...postData,
                                            title: e.target.value,
                                        });
                                        props.setAdditionalMovieValue({
                                            ...props.additionalMovieValue,
                                            title: e.target.value,
                                        });
                                    }}
                                />

                                <button type="button" onClick={searchImages}>
                                    <i className="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                            <div>
                                <img
                                    src={props.additionalMovieValue.poster_path}
                                    alt=""
                                />
                            </div>
                            <textarea
                                onChange={(e) =>
                                    setPostData({
                                        ...postData,
                                        memo: e.target.value,
                                    })
                                }
                            ></textarea>
                        </div>
                        <button type="button" onClick={onSubmit}>
                            登録
                        </button>
                    </div>
                </div>
            ) : (
                <></>
            )}
        </>
    );
};

export default AddModal;
